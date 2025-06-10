<script lang="ts" setup>
  const router = useRouter()

  const tab = ref(router.currentRoute.value.name as string)

  function goTo(routeName: string) {
    router.push(routeName)
    tab.value = routeName
  }
</script>

<template>
  <q-tabs
    v-for="route in router.getRoutes().filter(route => route.name)"
    :key="route.name"
    v-model="tab"
    shrink
    no-caps
    @update:model-value="goTo"
  >
    <q-tab :name="route.name" :label="route.name" />
  </q-tabs>
</template>
