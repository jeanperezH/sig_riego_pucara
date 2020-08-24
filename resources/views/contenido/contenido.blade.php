@extends('principal')
@section('contenido')

    <template v-if="menu==0">
        <inicio></inicio>
    </template>
    <template v-if="menu==1">
        <Rio></Rio>
    </template>
    <template v-if="menu==2">
        <compuerta></compuerta>
    </template>
    <template v-if="menu==3">
        <Canal></Canal>
    </template>
    <template v-if="menu==4">
        <Chacra></Chacra>
    </template>
    <template v-if="menu==5">
        <Rio2></Rio2>
    </template>
    <template v-if="menu==6">
        <compuerta2></compuerta2>
    </template>
    <template v-if="menu==7">
        <Canal2></Canal2>
    </template>
    <template v-if="menu==8">
        <Chacra2></Chacra2>
    </template>
    <template v-if="menu==9">
        <Rio3></Rio3>
    </template>
    <template v-if="menu==10">
        <compuerta3></compuerta3>
    </template>
    <template v-if="menu==11">
        <Canal3></Canal3>
    </template>
    <template v-if="menu==12">
        <Chacra3></Chacra3>
    </template>
    
@endsection