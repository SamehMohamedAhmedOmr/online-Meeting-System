<form dir="rtl" lang="ar" style="float:right;">

@foreach ($subjects as $indexKey => $item)
( الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }} )
    <br>
    {{ $item->subject_description}}
    <br>

@endforeach
</form>
