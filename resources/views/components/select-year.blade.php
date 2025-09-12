@php
    $year = date('Y');
@endphp

<select name=year> 
    <option name=""> Year </option>

    @for ($i = $year; $i>= 1970; $i--)

    <option value="{{ $i }}"> {{ $i }}</option>
        
    @endfor

</select>