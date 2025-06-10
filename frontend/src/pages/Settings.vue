<script lang="ts" setup>
  import { api } from '@/boot/axios'
  import { useDialogPluginComponent } from 'quasar'

  const { dialogRef, onDialogHide } = useDialogPluginComponent()

  const people = ref()
  const person = ref()

  api.get('/people').then(response => {
    people.value = response.data
  })

  function openDialog(currentPerson: any) {
    person.value = currentPerson
    dialogRef.value = true
  }

  function deletePerson(currentPerson: any) {
    api.delete(`/people/${currentPerson.id}`).then(() => {
      people.value = people.value.filter((p: any) => p.id !== currentPerson.id)
    })
    dialogRef.value = false
    onDialogHide()
    person.value = null
  }

  function editPerson() {
    api
      .put(`/people/${person.value.id}`, { name: person.value.name })
      .then(() => {
        people.value = people.value.map((p: any) =>
          p.id === person.value.id ? { ...p, name: person.value.name } : p
        )
      })
    dialogRef.value = false
    onDialogHide()
    person.value = null
  }
</script>

<template>
  <q-page padding>
    <div class="text-h4 q-mb-md">Settings</div>

    <q-list>
      <q-item v-for="person in people" :key="person.id">
        <q-item-section>
          <q-item-label>{{ person.name }}</q-item-label>
          <q-item-label caption>{{ person.email }}</q-item-label>
        </q-item-section>
        <q-item-section side>
          <q-item-label class="flex justify-center items-center gap-4" caption>
            <q-icon
              name="edit"
              color="primary"
              size="20px"
              @click="openDialog(person)"
            />
            <q-icon
              name="delete"
              color="negative"
              size="20px"
              @click="deletePerson(person)"
            />
          </q-item-label>
        </q-item-section>
      </q-item>
    </q-list>

    <q-dialog v-model="dialogRef" @hide="onDialogHide">
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Edit Person</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input v-model="person.name" filled label="Name" />
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn v-close-popup flat label="Cancel" />
          <q-btn v-close-popup flat label="OK" @click="editPerson" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>
