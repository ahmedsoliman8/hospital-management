<div id="multipleDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('Dashboard/main-sidebar_trans.delete')}}</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="empty_record hidden">
                        <h4>{{trans('Dashboard/main-sidebar_trans.please_check_some_records')}}</h4>
                    </div>
                    <div class="not_empty_record hidden">
                        <h4>{{trans('Dashboard/main-sidebar_trans.ask_delete_item')}} <span class="record_count"></span> ؟</h4>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="empty_record hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('Dashboard/main-sidebar_trans.close')}}</button>
                </div>
                <div class="not_empty_record hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('Dashboard/main-sidebar_trans.no')}}</button>
                    <input type="submit" class="btn btn-danger del_all" onsubmit="" name="del_all" value="{{trans('Dashboard/main-sidebar_trans.yes')}}"/>
                </div>
            </div>
        </div>

    </div>
</div>