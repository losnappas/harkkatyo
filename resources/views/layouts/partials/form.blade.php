@section('style')
	<link rel="stylesheet" href="{{ secure_asset('https://unpkg.com/purecss@0.6.2/build/pure-min.css') }}" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
@endsection
@section('script')
	<script src="//cdn.jsdelivr.net/medium-editor/latest/js/medium-editor.min.js"></script>
    <script src="https://cdn.rawgit.com/FranzSkuffka/vue-medium-editor/master/dist/vue-medium-editor.min.js" ></script>
@endsection
