<template>
  <b-modal
    id="modal-add-item"
    ref="modal"
    title="Create Item"
    @show="resetModal"
    @hidden="resetModal"
    @ok="handleOk"
  >
    <b-form @submit.prevent="onSubmit">
      <base-form-group
        id="name"
        label="Name"
        type="text"
        :optional="false"
        :value="item.name"
        @input="updateField"
        :validation="errors"
      ></base-form-group>

      <base-form-group
        id="description"
        label="Description"
        type="text"
        :textArea="true"
        :value="item.description"
        @input="updateField"
        :validation="errors"
      ></base-form-group>

      <base-form-group
        id="price"
        label="Price"
        type="number"
        :optional="false"
        :value="item.price"
        @input="updateField"
        :validation="errors"
      ></base-form-group>
    </b-form>

    <template #modal-footer="{ ok, cancel }">
      <base-button :loading="loading" @click="ok()">Create</base-button>
      <b-button @click="cancel()">
        Cancel
      </b-button>
    </template>
  </b-modal>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'AddItemModal',
  data () {
    return {
      loading: false,
      errors: []
    }
  },
  computed: {
    ...mapGetters({
      item: 'items/item'
    })
  },
  methods: {
    updateField (value, field) {
      this.$store.dispatch('items/set', {
        [field]: value
      })
    },
    resetModal () {
      this.$store.dispatch('items/reset')
      this.errors = []
    },
    handleOk (bvModalEvt) {
      bvModalEvt.preventDefault()

      this.onSubmit()
    },
    async onSubmit () {
      this.loading = true
      this.errors = []

      try {
        // Create the item
        await this.$store.dispatch('items/create')
        this.$bvModal.hide('modal-add-item')
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>
