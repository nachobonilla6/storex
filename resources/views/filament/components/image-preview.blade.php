<div>
    @if($image_url)
        <img src="{{ $image_url }}" alt="Image Preview" style="max-width: 200px; height: auto;">
    @else
        <p>No image to preview</p>
    @endif
</div>
