<template>
  <div data-testid="example-component">
    <h1>{{ title }}</h1>
    <p>This is an example component</p>
  </div>
</template>

<script setup lang="ts">
const title = 'Example Component'
</script>

<style scoped>
div {
  padding: 20px;
  border: 1px solid #ccc;
}
</style>