<a  class="dropdown-item" href="{{url('/markAsRead'.$notification->id)}}" style="color: rgb(27, 27, 27)">
    <strong>{{$notification->data['user']['name']}}</strong>&nbsp; sent a document to your department. 
    <div style="font-size: 11px;color:rgb(9, 136, 119); margin-left: 10px" class="float-left">{{$notification->created_at->diffForHumans()}}</div>
</a>