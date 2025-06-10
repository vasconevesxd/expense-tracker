<script lang="ts" setup>
  import Navbar from '@/components/Navbar.vue'
</script>

<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar class="text-white shadow-2">
        <q-toolbar-title>Tracker</q-toolbar-title>
        <q-space />
        <Navbar />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>
