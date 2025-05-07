<template>
    <svg :class="'absolute top-0 left-0 w-full ' + height" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <defs>
            <linearGradient id="waveGradient" x1="0" x2="1" y1="0" y2="0">
                <stop offset="0%" :stop-color=fromColor />
                <stop offset="100%" :stop-color=toColor />
            </linearGradient>
        </defs>
        <path fill="url(#waveGradient)" fill-opacity="1" d="M0,64L48,90.7C96,117,192,171,288,192C384,213,480,203,576,176C672,149,768,107,864,122.7C960,139,1056,213,1152,240C1248,267,1344,245,1392,234.7L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
    </svg>
</template>
<script setup>
    const props = defineProps({
        fromColor: {
            type: String,
            default: "#FFFFFF",
        },
        toColor: {
            type: String,
            default: "#FFFFFF",
        },
        height: {
            type: String,
            default: "h-44",
        },
    })
</script>
