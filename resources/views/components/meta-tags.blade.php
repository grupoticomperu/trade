@props(['titulo'=>'titulo con props', 'title'=>'title con props', 'description'=>'description con props', 'keywords'=>'palabras claves'])

<title>{{ $titulo }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">