<style>
    /* Page Loader */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.3s ease;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<!-- Page Loader -->
<div class="page-loader">
    <div class="spinner"></div>
</div>
<script>
    // Show loader when page is loading
    document.addEventListener('DOMContentLoaded', function() {
        // Hide loader after page loads
        setTimeout(function() {
            document.querySelector('.page-loader').style.opacity = '0';
            setTimeout(function() {
                document.querySelector('.page-loader').style.display = 'none';
            }, 300);
        }, 500);
    });
</script>
