<div class="table-filter" id="table-filter">
    <div class="table-filter-container">
        <form class="filter-form" id="filter-form" action="{{route($route.'_filter')}}" autocomplete="off">             

            {{ csrf_field() }}

            @foreach ($filters as $key => $items)
            
                @if($key == 'parent')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">Filtrar por</label>
                            </div>
                            <div class="form-input">
                                <select name="parent" data-placeholder="Seleccione una categoría" class="input-highlight">
                                    <option value="all">Todas</option>
                                    @foreach($items as $item)
                                        <option value="{{$item}}"}}>{{ $item }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'search')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="search" class="label-highlight">Buscar palabra</label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="search" class="input-highlight" value="">
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'category')
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">Filtrar por categoría</label>
                            </div>
                            <div class="form-input">
                                <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                    <option value="all"}}>Todas</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                    </div>    
                @endif

                @if($key == 'created_at')
                    <div class="two-columns">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="created_at_from" class="label-highlight">Desde una fecha de creación</label>
                            </div>
                            <div class="form-input">
                                <input type="date" name="created_at_from" class="input-highlight">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="created_at_since" class="label-highlight">Hasta una fecha de creación</label>
                            </div>
                            <div class="form-input">
                                <input type="date" name="created_at_since" class="input-highlight">
                            </div>
                        </div>
                    </div>    
                @endif             
                
            @endforeach

            <div class="two-columns">
                <div class="form-group">
                    <div class="form-label">
                        <label for="created_at_from" class="label-highlight">Ordenar por</label>
                    </div>
                    <div class="form-input">
                        <select name="order" class="input-highlight">
                            @foreach($order as $key => $item)
                                <option value="{{$item}}">{{ucfirst($key)}}</option>
                            @endforeach
                        </select>                   
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        <label for="direction" class="label-highlight hidden">Dirección</label>
                    </div>
                    <div class="form-input">
                        <select name="direction" class="input-highlight">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>                        
                    </div>
                </div>
            </div>  
        </form>
    </div>
    <div class="table-filter-buttons">
        <div class="table-filter-button open-filter button-active" id="open-filter">
            <p>Filtrar</p>
            <svg viewBox="0 0 24 24">
                <path fill="currentColor" d="M21 8H3V6H21V8M13.81 16H10V18H13.09C13.21 17.28 13.46 16.61 13.81 16M18 11H6V13H18V11M18 15V18H15V20H18V23H20V20H23V18H20V15H18Z" />
            </svg>
        </div>
        <div class="table-filter-button apply-filter" id="apply-filter">
            <p>Filtrar</p>
            <svg viewBox="0 0 24 24">
                <path fill="currentColor" d="M21 8H3V6H21V8M13.81 16H10V18H13.09C13.21 17.28 13.46 16.61 13.81 16M18 11H6V13H18V11M23 18H15V20H23V18Z" />
            </svg>
        </div>
    </div>
</div>

{{-- <div class="filters-container">

    
    <div class="filters-container-second-group">
        <div class="filter-buttons">
            @isset($order_route)
                <svg xmlns="http://www.w3.org/2000/svg" class="filter-button order-button" route="{{route($order_route)}}" viewBox="0 0 24 24">
                    <path class="order-button-icon" d="M14 5h8v2h-8zm0 5.5h8v2h-8zm0 5.5h8v2h-8zM2 11.5C2 15.08 4.92 18 8.5 18H9v2l3-3-3-3v2h-.5C6.02 16 4 13.98 4 11.5S6.02 7 8.5 7H12V5H8.5C4.92 5 2 7.92 2 11.5z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
            @endif
    
            @isset($date_filter)
                <svg xmlns="http://www.w3.org/2000/svg" class="filter-button daterange-button" viewBox="0 0 24 24">
                    <path class="daterange-button-icon" d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
            @endisset

            @isset($import)
                <svg viewBox="0 0 24 24" class="filter-button import-button"  route="{{route($import)}}">
                    <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
                </svg>
            @endif

            @isset($ping)
                <svg style="width:2em;height:2em;margin-top: 0.25em;" viewBox="0 0 24 24" class="filter-button google-button" data-route="{{route($ping)}}">
                    <path d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z" />
                </svg>
            @endif   
        </div>

        @isset($subfilter)
            <div class="subfilter-select-container"> 
                <select 
                    id="subfilter" 
                    class="filter-select form-control primary-select-related">
                        <option value="todas">Todas</option>
                        @foreach($subfilter as $subfilter_input)
                            <option value="{{$subfilter_input->id}}" name='{{$subfilter_input->name}}'>{{$subfilter_input->name}}</option>
                        @endforeach
                </select>
            </div>
        @endisset     
        
    </div>

</div> --}}