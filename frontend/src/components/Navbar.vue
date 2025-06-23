<script lang="ts" setup>
  import { toPascalCase } from '@/utils'

  const router = useRouter()

  const visibleRoutes = router
    .getRoutes()
    .filter(
      route => route.name && !['404', 'login'].includes(route.name.toString())
    )

  const tab = ref(router.currentRoute.value.name as string)

  function goTo(routeName: string) {
    const path =
      routeName === 'dashboard' ? { name: 'dashboard' } : { name: routeName }
    router.push(path)
    tab.value = routeName
  }
</script>

<template>
  <q-tabs v-model="tab" shrink @update:model-value="goTo">
    <q-tab
      v-for="route in visibleRoutes"
      :key="route.name"
      :name="route.name"
      no-caps
      :label="toPascalCase(route.name)"
    />
  </q-tabs>
</template>
