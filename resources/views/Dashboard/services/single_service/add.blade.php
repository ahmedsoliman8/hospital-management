<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('single_service.add_single_services')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('service.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('single_service.' . $localeCode . '.name')}}</label>
                            <input type="text" name="{{ $localeCode }}[name]" class="form-control" value="{{ old($localeCode . '.name') }}">
                        </div>
                    @endforeach

                        <div class="form-group">
                            <label>{{trans('single_service.price')}}</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label>{{trans('single_service.description')}}</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>


                    {{--
                    <label for="exampleInputPassword1">{{trans('single_service.name_sections')}}</label>
                    <input type="text" name="name" class="form-control">
                    --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
