@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<a class="btn btn-default" href="admin/category/create" role="button">Create</a>
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Status</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list as $item)
						<tr>
							<td> {{ $item->id }} </td>
							<td> {{ $item->name }} </td>
							<td> 
								<a rel="{{$item->id}}" status="{{$item->active}}" class="changeStaus" href="#">
									<img src="{{ asset('assets/icon').'/'.$item->active}}.png">
								</a> 
							</td>
							<td>
							<a class="btn btn-success" href="category/{{ $item->id }}" role="button">show</a>
							<a class="btn btn-primary" href="category/{{ $item->id }}/edit" role="button">Edit</a> 
							<a class="btn btn-danger" href="category/destroy/{{ $item->id }}" role="button">Delete</a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	 <div class="row text-center">
	 	{!! $list->render() !!}
	 </div>
</div>
@stop()


@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-danger").click(function(e){
			e.preventDefault();
			if(!confirm('Are you sure you want to delete this item?')) return false;
			var btn = $(this);
			var url_ = btn.attr('href');
			$.ajax({
				url:url_,
				success:function(result){
					btn.closest('tr').fadeOut();
				}
			});
		});
		$(".changeStaus").click(function(e){
			e.preventDefault();
			var btn = $(this);
			var id_ = btn.attr('rel');
			var url_ = "{{Url('admin/category/changeStatus')}}";
			var oldstatus = btn.attr('status');
			var newstatus = 0;
			if(oldstatus==0){
				newstatus = 1;
			}
			var imgsrc = btn.find('img').attr('src');
			imgsrc = imgsrc.replace(oldstatus+'.png',newstatus+'.png');
			//console.log(imgsrc);
			$.ajax({
				url:url_,
				type: "POST",
				data:{id:id_,status:newstatus,_token:$('input[name=_token]').val()},
				success:function(result){		
					btn.attr('status',newstatus);
					btn.find('img').attr('src',imgsrc);
				}
			});
		});
	});
</script>
@stop()