<x-layout title="Editar Série '{!! $serie->name !!}'">
   <x-series.form :action="route('series.update', $serie->id)" :name="$serie->name" :update="true" />
</x-layout>