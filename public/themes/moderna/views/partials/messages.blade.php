<div id="messages" class="row" style="margin-top: 10px;margin-bottom: 10px;">
    <div class="col-md-12">
        @if(Session::get('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
        @if(Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (count($errors->all()) > 0)
        @foreach ($errors->all(':message') as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        @endif
    </div>
</div>

