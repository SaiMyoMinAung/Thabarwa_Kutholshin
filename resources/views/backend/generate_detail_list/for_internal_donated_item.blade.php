<table cellpadding="5" cellspacing="0" style="padding-left:50px;background:lightblue">
    <tr>
        <th>{{trans('input.no')}}</th>
        <th>{{trans('input.item_sub_type')}}</th>
        <th>{{trans('input.sacket_per_package')}}</th>
        <th>{{trans('input.amount')}}</th>
        <th>{{trans('input.status')}}</th>
        <th>{{trans('input.option')}}</th>
    </tr>
    @foreach($datas as $data)
    <tr class="@if($data['uuid'] == $uuid) bg bg-primary @endif">
        <td>{{$data['no']}}</td>
        <td>{{$data['item_sub_type_name']}}</td>
        <td>( {!!$data['per_qty']!!} )</td>
        <td>{!!$data['amount']!!}</td>
        <td>{!! $data['status'] !!}</td>
        <td>
            @if ((bool) $data['canEdit'])
            <button class="btn btn-sm btn-warning" data-uuid="{{$data['uuid']}}" data-toggle="editconfirmation" data-href="{{route('internal_donated_items.edit',$data['uuid'])}}">{{trans('button.edit')}}</button>
            @else
            -
            @endif
            /
            @if ($data['canDelete'])
            <button class="btn btn-sm btn-danger" data-toggle="confirmation" data-href="{{route('internal_donated_items.destroy',$data['uuid'])}}">{{trans('button.delete')}}</button>
            @else
            -
            @endif
            /
            @if ((bool) $data['canCreate'])
            <a class="btn btn-xs btn-primary" href="{{route('internal_donated_items.create',['uuid'=>$data['uuid']])}}">စာရင်း ထပ်သွင်းမည်</a>
            @else
            -
            @endif
        </td>
    </tr>
    @endforeach
</table>