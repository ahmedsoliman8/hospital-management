<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">اضافة مجموعة خدمات </button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>الاسم</th>
            <th>الملاحظات</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($groups as $group)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->notes }}</td>
                <td>
                    <button wire:click="edit({{ $group->id }})"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $group->id }})" ><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
