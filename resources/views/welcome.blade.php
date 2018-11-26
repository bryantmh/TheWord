@extends('layout')

@section('content')
	<div class="row">
		<div class="column">
			<h2>{{$left['Header']}}</h2>
			<select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
				@foreach ($leftOptions as $key => $item)
					@if ($key == 0)
			    		<option value="/{{$item}}/{{$rightOptions[0]}}" selected>{{strtoupper($item)}}</option>
			    	@else
			    		<option value="/{{$item}}/{{$rightOptions[0]}}">{{strtoupper($item)}}</option>
			    	@endif
			    @endforeach
			</select>
			@foreach ($left['Matthew'] as $chapterKey => $chapter)
				<br><br><h4>{{$chapterKey}}</h4>
				@foreach ($chapter as $verseNumber => $verse)
					@if (strpos($verseNumber, "stanza") !== false)
						<span style="padding-left: 20px;">{{"\t".$verse}}</span><br>
					@elseif (strpos($verseNumber, 'Header') === false)
						{{$verseNumber}}:&nbsp;
						{{$verse}}<br>
					@endif
				@endforeach
			@endforeach
		</div>
		<div class="column">
			<h2>{{$right['Header']}}</h2>
			<select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
				@foreach ($rightOptions as $key => $item)
					@if ($key == 0)
			    		<option value="/{{$leftOptions[0]}}/{{$item}}" selected>{{strtoupper($item)}}</option>
			    	@else
			    		<option value="/{{$leftOptions[0]}}/{{$item}}">{{strtoupper($item)}}</option>
			    	@endif
			    @endforeach
			</select>
			@foreach ($right['Matthew'] as $chapterKey => $chapter)
				<br><br><h4>{{$chapterKey}}</h4>
				@foreach ($chapter as $verseNumber => $verse)
					@if (strpos($verseNumber, 'Header') === false)
						{{$verseNumber}}:&nbsp;
						{{$verse}}<br>
					@endif
				@endforeach
			@endforeach
		</div>
	</div>
@endsection