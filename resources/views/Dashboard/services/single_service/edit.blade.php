<!-- Modal -->
<div class="modal fade" id="edit{{ $singleService->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('single_service.edit_single_service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('service.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $singleService->id }}">
                    {{--
                 <label for="exampleInputPassword1">{{trans('Dashboard/sections_trans.name_sections')}}</label>


                 <input type="text" name="name" value="{{ $section->name }}" class="form-control">
                 --}}
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('single_service.' . $localeCode . '.name')}}</label>
                            <input type="text" name="{{ $localeCode }}[name]" class="form-control" value="{{  $singleService->translateOrNew($localeCode)->name }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label>{{trans('single_service.price')}}</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{  $singleService->price }}">
                    </div>

                    <div class="form-group">
                        <label>{{trans('single_service.description')}}</label>
                        <textarea name="description" class="form-control">{{  $singleService->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">{{trans('single_service.status')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{trans('doctors.choose')}}--</option>
                            <option {{$singleService->status==1?"selected":""}} value="1">{{trans('doctors.enabled')}}</option>
                            <option  {{$singleService->status==0?"selected":""}} value="0">{{trans('doctors.not_enabled')}}</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
