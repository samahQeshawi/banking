<div class="read-only-ratings" data-rating="{{ $rating }}"></div>
  
 <script>
    function initReadOnlyRatings() {
        $('.read-only-ratings').each(function () {
            const rating = $(this).data('rating') || 0;

            $(this).rateYo({
                rating: rating,
                readOnly: true,
                rtl: {{ app()->getLocale() === 'ar' ? 'true' : 'false' }},
                spacing: '8px',
                starWidth: "20px"
            });
        });
    }

    // عند أول تحميل للصفحة
    $(document).ready(function () {
        initReadOnlyRatings();
    });
 </script>
