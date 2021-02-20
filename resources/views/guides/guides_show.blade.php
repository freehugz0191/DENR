@extends('layouts.app')
{{-- CKEditor CDN --}}
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
@section('content')

        <div class="card">
            <div class="card-header">
              <strong>{{$trandesc->tran_desc}}</strong>
              <button class="btn btn-outline-success float-right"  data-toggle="modal" data-target="#edit">Edit Guide</button>
            </div>
            <div class="card-body">{!! html_entity_decode($trandesc->guide) !!}</div>
            
        </div>

 <!-- Edit Modal -->
 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title pull-left" id="myModalLabel">Edit Transaction Guide</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{ url('edit_guide/'.$trandesc->id)}}" method="post" enctype="multipart/form-data">
            {{method_field('patch')}}
            {{csrf_field()}}
          <div class="modal-body">
              <input type="hidden" name="tran_id" id="tran_id" value="{{$trandesc->id}}">
          @include('guides.guideform')
         
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    CKEDITOR.replace('guide', {
      width: '460',
      height: 300
    });

    CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Templates,Source,NewPage,ExportPdf,Preview,Print,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,CopyFormatting,RemoveFormat';
};
  </script>
@endsection