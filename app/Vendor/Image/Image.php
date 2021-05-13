<?php

namespace App\Vendor\Image;

use Illuminate\Support\Facades\Storage;
use App\Vendor\Image\Models\ImageConfiguration;
use App\Vendor\Image\Models\ImageOriginal;
use App\Vendor\Image\Models\ImageResized;
use App\Jobs\ProcessImage;
use App\Jobs\DeleteImage;
use Jcupitt\Vips;
use Debugbar;

class Image
{
	protected $entity;
	protected $extension_conversion;
	
	public function setEntity($entity)
	{
		$this->entity = $entity;
	}

	public function storeRequest($request, $extension_conversion, $foreign_id){

		$this->extension_conversion = $extension_conversion;
		
		foreach($request as $key => $file){

			$key = str_replace(['-', '_'], ".", $key); 
			$explode_key = explode('.', $key);
			$content = reset($explode_key);
			$language = end($explode_key);

			$image = $this->store($file, $foreign_id, $content, $language);
			$this->store_resize($file, $foreign_id, $content, $language, $image->path);
		}
	}

	public function store($file, $entity_id, $content, $language){

		/* convertimos el nombre del archivo y nombre de extension a minúsculas */
		$name = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
		$name = str_replace(" ", "-", $name);
		$file_extension = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
		/* Asignamos el nombre del archivo con el formato */
		$filename = $name .'.'. $file_extension;
		/* En un archivo svg no podemos conseguir el ancho y alto, para el resto de formatos,
		obtenemos el tamaño de la imagen con la función propia de PHP getimagesize()*/
		if($file_extension != 'svg'){
			$data = getimagesize($file);
			/*Data nos devuelve las características de la imagen */
			$width = $data[0];
			$height = $data[1];
		}

		/* Una vez hemos diseñado las tablas, para guardar los datos, hemos de tratarlos y prepararlos.
		En este caso, el vendor de Image, se encarga de meter esos datos tratados. Una vez hecho esto,
		se guarda la imagen y los datos */

		/* this->entity en este caso es faqs */
		
		$settings = ImageConfiguration::where('entity', $this->entity)
		->where('content', $content)
		->where('grid', 'original')
		->first();

		/* Path tenemos donde queremos guardar las imágenes. Entity se refiere a la página en la que queremos
		guardar (faqs, users, etc), language (extension , es, en ... ), /original/, nombre, etc y todos los 
		argumentos de la dirección que indiquemos */

		$path = '/' . $entity_id . '/' . $language . '/' . $content . '/original/' . $name . '.' . $file_extension;
		$path = str_replace(" ", "-", $path);

		/* Comprueba si el tipo de imagen es una sola, entonces ejecuto. En caso de guardar una imagen que
		tuviese el mismo nombre, machacaria el dato y lo remplaza.*/

		if($settings->type == 'single'){

			/* Llamamos al objeto Storage de Laravel para guardar la imagen, o cualquier otro archivo*/

			Storage::disk($this->entity)->deleteDirectory('/' . $entity_id . '/' . $language . '/' . $content . '/original');
			/**Le indicamos la ruta, el archivo , etc . disk en laravel es la carpeta */
			Storage::disk($this->entity)->putFileAs('/' . $entity_id . '/' . $language . '/' . $content . '/original', $file, $filename);
			/**  */
			$image = ImageOriginal::updateOrCreate([
				'entity_id' => $entity_id,
				'entity' => $this->entity,
				'language' => $language,
				'content' => $content],[
				'path' => $this->entity . $path,
				'filename' => $filename,
				'mime_type' => 'image/'. $file_extension,
				'size' => $file->getSize(),
				'width' => isset($width)? $width : null,
				'height' => isset($height)? $height : null,
			]);
		}

		/* Este caso, lo que guardamos es una colección de imágenes. Suponiendo que subimos dos fotos con el 
		mismo nombre. Para evitar que se machaquen, declaramos la variable $counter = 2;, y le añadimos a la
		foto que se repita le añadimos un 2. */

		elseif($settings->type == 'collection'){

			$counter = 2;

			/* Mientras exista $path, con la funcion exists(), si existe, entonces, le metemos al nombre el counter */ 
 
			while (Storage::disk($this->entity)->exists($path)) {
				
				$path = '/' . $entity_id . '/' . $language . '/' . $content . '/original/' . $name.'-'. $counter.'.'. $file_extension;
				$filename =  $name.'-'. $counter.'.'. $file_extension;
				$counter++;
			}

			Storage::disk($this->entity)->putFileAs('/' . $entity_id . '/' . $language . '/' . $content . '/original', $file, $filename);

			$image = ImageOriginal::create([
				'entity_id' => $entity_id,
				'entity' => $this->entity,
				'language' => $language,
				'content' => $content],[
				'path' => $this->entity . $path,
				'filename' => $filename,
				'mime_type' => 'image/'. $file_extension,
				'size' => $file->getSize(),
				'width' => isset($width)? $width : null,
				'height' => isset($height)? $height : null,
			]);
		}

		return $image;
	}

	public function store_resize($file, $entity_id, $content, $language, $original_path){

		$name = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
		$file_extension = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
		$settings = ImageConfiguration::where('entity', $this->entity)
					->where('content', $content)
					->where('grid', '!=', 'original') /** Cojemos la config diferente de original */
					->get();

		foreach ($settings as $setting => $value) {

			/** Buscamos el tipo de archivos aceptados, y nos devuelve un array de 4 elementos (los tipos) */
			$content_accepted = explode("/", $value->content_accepted);
			/** Si la extension no se encuenta , entonces continua */
			if(!in_array($file_extension, $content_accepted)){
				continue; /** Es como un return pero no para todo, solo el proceso... insert some serious*/
			}
			
			/** Si el archivo es de tipo svg, no lo transforma, ya que este formato no lo permite */
			if($file_extension == 'svg'){
				$directory = '/' . $entity_id . '/' . $language . $value->directory; 
				$path = $directory . '/' . $name . '.' . $file_extension;
				$path = str_replace(" ", "-", $path);
				$filename = $name . '.' . $file_extension;
			/** El resto lo transforma en el tipo de archivo webp */
			}else{
				$directory = '/' . $entity_id . '/' . $language . $value->directory; 
				$path = $directory . '/' . $name . '.' . $this->extension_conversion;
				$path = str_replace(" ", "-", $path);
				$filename = $name . '.' . $this->extension_conversion;
			}		

			/** Si la imagen que subimos es una sola... */
			if($value->type == 'single'){

				/** Llamamos al Job ProcessImage, que lo mandaremos por medio de una cola */
				ProcessImage::dispatch(
					$entity_id,
					$value->entity,
					$directory,
					$value->grid,
					$language, 
					$value->disk,
					$path, 
					$filename, 
					$value->content,
					$value->type,
					$file_extension,
					$this->extension_conversion,
					$value->width,
					$value->quality,
					$original_path, 
					$value->id
					/** Estamos enviando a una cola, llamada process_image. En la carpeta Jobs,
					 * creamos un archivo donde mandaremos la cola
					 */
				)->onQueue('process_image');
			}

			elseif($value->type == 'collection'){

				$counter = 2;

				while (Storage::disk($value->disk)->exists($path)) {
					
					if($file_extension == 'svg'){
						$path =  '/' . $entity_id . '/' . $language . $value->directory . '/' . $name.'-'. $counter.'.'. $file_extension;
						$filename = $name .'-'. $counter.'.'. $file_extension;
						$counter++;
					}else{
						$path =  '/' . $entity_id . '/' . $language . $value->directory . '/' . $name.'-'. $counter.'.'. $this->extension_conversion;
						$filename = $name .'-'. $counter.'.'. $this->extension_conversion;
						$counter++;
					}		
				}

				ProcessImage::dispatch(
					$entity_id,
					$value->entity,
					$directory,
					$value->grid,
					$language, 
					$value->disk,
					$path, 
					$filename, 
					$value->content,
					$value->type,
					$extension,
					$this->extension_conversion,
					$value->width,
					$value->quality,
					$original_path, 
					$value->id
				)->onQueue('process_image');
			}
		}
	}

	public function show($entity_id, $language)
	{
		return ImageOriginal::getPreviewImage($this->entity, $entity_id, $language)->first();
	}

	public function preview($entity_id)
	{
		$items = ImageOriginal::getPreviewImage($this->entity, $entity_id)->pluck('path','language')->all();

        return $items;
	}

	public function galleryImage($entity, $grid, $entity_id, $filename)
	{
		
		$image = ImageOriginal::getGalleryImage($entity, $entity_id, $filename, $grid)->first();

		return response()->json([
			'path' => Storage::url($image->path),
		]); 
	}

	public function galleryPreviousImage($entity, $grid, $entity_id, $id)
	{		

		$image = ImageOriginal::getGalleryPreviousImage($entity_id, $entity, $grid, $id)->first();

		$previous = route('gallery_previous_image', ['entity' => $entity, 'grid' => $grid, 'entity_id' => $entity_id, 'id' => $image->id]);
		$next = route('gallery_next_image', ['entity' => $entity, 'grid' => $grid, 'entity_id' => $entity_id, 'id' => $image->id]);

		return response()->json([
			'path' => Storage::url($image->path),
			'previous' => $previous,
			'next' => $next
		]); 
	}

	public function galleryNextImage($entity, $grid, $entity_id, $id)
	{

		$image = ImageOriginal::getGalleryNextImage($entity_id, $entity, $grid, $id)->first();

		$previous = route('gallery_previous_image', ['entity' => $entity, 'grid' => $grid, 'entity_id' => $entity_id, 'id' => $image->id]);
		$next = route('gallery_next_image', ['entity' => $entity, 'grid' => $grid, 'entity_id' => $entity_id, 'id' => $image->id]);

		return response()->json([
			'path' => Storage::url($image->path),
			'previous' => $previous,
			'next' => $next
		]); 
	}

	public function original($entity_id)
	{
		$items = ImageOriginal::getOriginalImage($this->entity, $entity_id)->pluck('path','language')->all();

        return $items;
	}

	public function getAllByLanguage($language){ 

        $items = ImageOriginal::getAllByLanguage($this->entity, $language)->get()->groupBy('entity_id');

        $items =  $items->map(function ($item) {
            return $item->pluck('path','grid');
        });

        return $items;
    }

	public function destroy(ImageOriginal $image)
	{
		DeleteImage::dispatch($image->filename, $image->content, $image->entity)->onQueue('delete_image');

		$message = \Lang::get('admin/media.media-delete');

		return response()->json([
            'message' => $message,
        ]);
	}

	public function delete($entity_id)
	{
		if (ImageOriginal::getImages($this->entity, $entity_id)->count() > 0) {

			$images = ImageOriginal::getImages($this->entity, $entity_id)->get();

			foreach ($images as $image){
				Storage::disk($image->entity)->delete($image->path);
				$image->delete();
			}
		}
	}
}
