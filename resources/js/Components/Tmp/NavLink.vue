<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
			classes() {
                return this.active
                    ? 'w-full flex items-center text-blue-400 h-10 pl-4 bg-blue-100 hover:bg-blue-100 cursor-pointer border-l-4 border-blue-500'
                    : 'w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-blue-100 cursor-pointer border-l-4'
            },
        }
    })

	//active cursor-pointer px-0 py-3 text-primary-500 flex items-center border-l-3 border-solid border-primary-500 bg-gray-100

</script>
