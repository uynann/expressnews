<!-- /.modal -->
<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
            <div class="modal-body">
                <p>Are you sure want to do this?</p>
            </div>
            <div class="modal-footer">
                @if(isset($user))
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class' => 'delete-item-form']) !!}
                {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

                @elseif(isset($post))
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'class' => 'delete-item-form']) !!}
                {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

                @elseif(isset($category))
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id], 'class' => 'delete-item-form']) !!}
                {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

                @elseif(isset($tag))
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminTagsController@destroy', $tag->id], 'class' => 'delete-item-form']) !!}
                {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

                @elseif(isset($photo))
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id], 'class' => 'delete-item-form']) !!}
                {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
