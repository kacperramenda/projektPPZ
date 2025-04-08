<script setup>
import MenuItem from '@/components/admin/MenuItem.vue';
import UserIcon from '@/components/icons/UserIcon.vue';

const menuItems = [
    {
        name: 'Users',
        icon: UserIcon,
        route: 'admin.users',
    },
];
</script>

<template>
    <ul class="menu lg:menu-horizontal rounded-box h-full w-full">
        <MenuItem
            v-for="(item, index) in menuItems"
            :key="index"
            :name="item.name"
            :icon="item.icon"
            :routeName="item.route"
        />
    </ul>
</template>
