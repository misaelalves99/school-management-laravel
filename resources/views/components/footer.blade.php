<!-- resources/views/components/footer.blade.php -->

@push('styles')
    @vite(['resources/css/components/footer.css'])
@endpush

<footer class="footer">
    &copy; {{ date('Y') }} Minha Escola
</footer>
