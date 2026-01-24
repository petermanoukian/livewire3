@extends('layouts.appadmin')

@section('title', 'Manage Products')

<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

@section('content')
<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        Products
    </h2>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div id="prods-list">
                @livewire('admin.prods.prod-component', ['catid' => $catid, 'subcatid' => $subcatid])
            </div>

        </div>
    </div>
</div>
@endsection

<script>
    window.addEventListener('scroll-to-cats', () => {
        const el = document.getElementById('prods-list');
        if (!el) return;

        const y = el.getBoundingClientRect().top + window.pageYOffset - 80;
        window.scrollTo({ top: y, behavior: 'smooth' });
    });

    window.addEventListener('scroll-to-form', () => {
        const el = document.getElementById('cat-form');
        if (!el) return;

        const y = el.getBoundingClientRect().top + window.pageYOffset - 80;
        window.scrollTo({ top: y, behavior: 'smooth' });
    });

    document.addEventListener('trix-change', function (event) {
        let input = event.target.inputElement;
        if (!input) return;

        let component = Livewire.find(
            event.target.closest('[wire\\:id]').getAttribute('wire:id')
        );

        component.set(input.getAttribute('wire:model.defer'), input.value);
    });
</script>
