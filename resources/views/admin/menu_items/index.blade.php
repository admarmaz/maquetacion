@php
    $route = 'menus_item';
@endphp

<div id="menu-item-modal-container">
    @include('admin.components.modal_menu_item', ['menu' => $menu])
</div>

@component('admin.components.locale', ['tab' => 'content'])

    @foreach ($localizations as $localization)

        <div class="tab-language {{ $loop->first ? 'active-tabs-locale' :'' }}" data-tab = "content" data-localetab = "{{$localization->alias}}">
                
            <div class="one-column">
                <div class="formulario-grupo">
                    <div class="formulario-label">
                        <label>
                            Pulse <span class="menu-item-create" data-url="{{route('menus_item_create')}}" data-menu="{{$menu->id}}" data-language="{{$localization->alias}}">aquí</span> para añadir un nuevo elemento al menu.
                        </label>
                    </div>
                </div>
            </div>

            @if($menu->parent_items->count() > 0)
                <div class="one-column">
                    <div class="form-group">
                        @include('admin.components.items_nestables', [
                            'language' => $localization->alias,
                            'item' => $menu->id,
                            'route' => 'menus_item_index', 
                            'order_route' => 'menus_reorder',
                            'edit_route' => 'menus_item_edit',
                            'delete_route' => 'menus_item_destroy',
                            'edit_class' => 'menu-item-edit',
                            'delete_class' => 'menu-item-delete'
                        ])
                    </div>
                </div>
            @endif
            
        </div>

    @endforeach

    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
        <path fill="currentColor" d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z" />
    </svg>

    <div class="topbar-element topbar-localization">
        @include('front.components.desktop.localization')
    </div>

@endcomponent
            
