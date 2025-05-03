<template>
    <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
        {{ $page.props.flash.success }}
    </div>
</template>
