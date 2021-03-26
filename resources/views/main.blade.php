@extends('layouts.app')

@if(count($adverts) > 0)
    @include('advert.index')
@endif
