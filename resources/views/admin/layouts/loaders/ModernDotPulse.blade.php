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

    .dot-pulse {
        position: relative;
        left: -9999px;
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: #3498db;
        color: #3498db;
        box-shadow: 9999px 0 0 -5px #3498db;
        animation: dot-pulse 1.5s infinite linear;
        animation-delay: 0.25s;
    }

    .dot-pulse::before,
    .dot-pulse::after {
        content: '';
        display: inline-block;
        position: absolute;
        top: 0;
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: #3498db;
        color: #3498db;
    }

    .dot-pulse::before {
        box-shadow: 9984px 0 0 -5px #3498db;
        animation: dot-pulse-before 1.5s infinite linear;
        animation-delay: 0s;
    }

    .dot-pulse::after {
        box-shadow: 10014px 0 0 -5px #3498db;
        animation: dot-pulse-after 1.5s infinite linear;
        animation-delay: 0.5s;
    }

    @keyframes dot-pulse-before {
        0% {
            box-shadow: 9984px 0 0 -5px #3498db;
        }

        30% {
            box-shadow: 9984px 0 0 2px #3498db;
        }

        60%,
        100% {
            box-shadow: 9984px 0 0 -5px #3498db;
        }
    }

    @keyframes dot-pulse {
        0% {
            box-shadow: 9999px 0 0 -5px #3498db;
        }

        30% {
            box-shadow: 9999px 0 0 2px #3498db;
        }

        60%,
        100% {
            box-shadow: 9999px 0 0 -5px #3498db;
        }
    }

    @keyframes dot-pulse-after {
        0% {
            box-shadow: 10014px 0 0 -5px #3498db;
        }

        30% {
            box-shadow: 10014px 0 0 2px #3498db;
        }

        60%,
        100% {
            box-shadow: 10014px 0 0 -5px #3498db;
        }
    }
</style>
<div class="page-loader">
    <div class="dot-pulse"></div>
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
