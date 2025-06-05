# Admin Dashboard Page

The `Admin Dashboard` page serves as the main interface for administrators to view and manage key metrics, data, and actions within the application.

## Features

- Displays an overview of application statistics and metrics.
- Provides quick access to administrative actions and tools.
- Includes widgets or sections for data visualization (e.g., charts, tables).

## Dependencies

- **Components**:
  - `Header` - Displays the page header with navigation or branding.
  - `Sidebar` - Provides navigation links for the admin panel.
  - `Panel` - Displays key metrics or actions in a card-like layout.
  - `Table` - Used for displaying tabular data.

## Example Usage

```vue
<template>
  <div class="admin-dashboard">
    <Header />
    <div class="dashboard-layout">
      <Sidebar />
      <main>
        <Panel title="Users" :data="userStats" />
        <Panel title="Revenue" :data="revenueStats" />
        <Table :rows="recentActivities" />
      </main>
    </div>
  </div>
</template>

<script setup>
import Header from '@/components/admin/Header.vue';
import Sidebar from '@/components/admin/Sidebar.vue';
import Panel from '@/components/admin/Panel.vue';
import Table from '@/components/table/Table.vue';

const userStats = { count: 1200, growth: '5%' };
const revenueStats = { total: '$50,000', growth: '10%' };
const recentActivities = [
  { id: 1, action: 'User registered', timestamp: '2023-10-01' },
  { id: 2, action: 'Order placed', timestamp: '2023-10-02' },
];
</script>