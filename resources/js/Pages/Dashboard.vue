<template>
    <app-layout title="Dashboard">
		<template #header>
			<li class="flex items-center text-blue-500">
				<Link :href="'#'" class="text-gray-700" >Dashboard</Link>
			</li>
		</template>

        <div class="max-w-full mx-auto py-7">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <welcome />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
	import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            Welcome, 
        },
    })
</script>
