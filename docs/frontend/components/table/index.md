# Table Component

The `Table` component is a styled container for displaying tabular data. It provides a flexible structure for organizing and presenting data in rows and columns.

## Props

This component does not accept any props directly.

## Dependencies

This component does not have any external dependencies.

## Example Usage

```vue
<template>
  <Table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Alice</td>
        <td>30</td>
        <td>New York</td>
      </tr>
      <tr>
        <td>Bob</td>
        <td>25</td>
        <td>San Francisco</td>
      </tr>
    </tbody>
  </Table>
</template>

<script setup>
import Table from '@/components/Table.vue';
</script>