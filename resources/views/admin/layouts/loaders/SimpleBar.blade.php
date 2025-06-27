<style>
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .bar-loader {
        width: 200px;
        height: 4px;
        background-color: #e0e0e0;
        border-radius: 2px;
        overflow: hidden;
    }

    .bar-loader::after {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        background-color: #3498db;
        border-radius: 2px;
        animation: bar-loading 1.5s ease-in-out infinite;
    }

    @keyframes bar-loading {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }
</style>
<div class="page-loader">
    <div class="bar-loader"></div>
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
