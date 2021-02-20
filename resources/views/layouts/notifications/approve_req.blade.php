<a  class="dropdown-item" href="{{url('/markAsReadReq'.$notification->id)}}" style="color: rgb(27, 27, 27)">
    Document you requested approved by &nbsp;<strong>{{$notification->data['user']['name']}}</strong>.
    <div style="font-size: 11px;color:rgb(9, 136, 119); margin-left: 10px" class="float-left">{{$notification->created_at->diffForHumans()}}</div>
</a>