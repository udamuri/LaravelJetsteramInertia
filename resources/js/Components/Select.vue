<template>
  <select
    class = "border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm
				disabled:cursor-not-allowed disabled:bg-gray-300"
    @change="$emit('update:modelValue', $event.target.value)"
    ref="select"
  >
    <option
      v-for="(data, key) in options"
      :key="key"
	  :model="JSON.stringify(data)"
      :value="data.id"
      :selected="data.id === modelValue"
      :disabled="data?.disabled"
    >
      {{ data.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: ["modelValue", "options", "model"],

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.select.focus();
    },
  },
};
</script>
