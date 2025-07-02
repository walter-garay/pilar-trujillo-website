<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="'/assets/images/brand/isotipo.png'" :class="className" v-bind="$attrs" alt="Isotipo Reencuentro ,Medios" />
</template>
