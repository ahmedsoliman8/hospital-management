<!-- Modal -->
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections_trans.edit_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sections.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $section->id }}">
                    {{--
                 <label for="exampleInputPassword1">{{trans('Dashboard/sections_trans.name_sections')}}</label>


                 <input type="text" name="name" value="{{ $section->name }}" class="form-control">
                 --}}
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('Dashboard/sections_trans.' . $localeCode . '.name_sections')}}</label>
                            <input type="text" name="{{ $localeCode }}[name]" class="form-control" value="{{  $section->translateOrNew($localeCode)->name }}">
                        </div>
                    @endforeach

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('Dashboard/sections_trans.' . $localeCode . '.description_sections')}}</label>
                            <textarea name="{{ $localeCode }}[description]" class="form-control" >{{  $section->translateOrNew($localeCode)->description }}</textarea>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
