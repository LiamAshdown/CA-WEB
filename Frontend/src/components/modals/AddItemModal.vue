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
        v-model="form.name"
        :optional="false"
        :validation="errors"
      ></base-form-group>

      <base-form-group
        id="description"
        label="Description"
        type="text"
        v-model="form.description"
        :textArea="true"
        :validation="errors"
      ></base-form-group>

      <base-form-group
        id="price"
        label="Unit Price"
        type="number"
        v-model="form.unitPrice"
        :optional="false"
        :validation="errors"
      ></base-form-group>

      <b-form-group label="VAT">
        <b-form-select v-model="form.vat" :options="vatOptions"></b-form-select>
      </b-form-group>

      <base-form-group
        id="net"
        label="Net"
        type="number"
        :value="calculateNet"
        :optional="true"
        :validation="errors"
        disabled
      ></base-form-group>

      <base-form-group
        id="gross"
        label="Gross"
        type="number"
        :value="calculateGross"
        :optional="true"
        :validation="errors"
        disabled
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
export default {
  name: 'AddItemModal',
  data () {
    return {
      loading: false,
      errors: [],
      vatOptions: [
        { value: 5, text: '5%' },
        { value: 10, text: '10%' },
        { value: 20, text: '20%' }
      ],
      form: {
        name: '',
        description: '',
        unitPrice: 0.00,
        net: 0.00,
        vat: 0.00,
        gross: 0.00
      }
    }
  },
  computed: {
    calculateGross () {
      return this.form.unitPrice * (1 + this.form.vat / 100)
    },
    calculateNet  () {
      return this.form.unitPrice
    }
  },
  methods: {
    resetModal () {
      this.errors = []
      this.form = {
        name: '',
        description: '',
        unitPrice: 0.00,
        net: 0.00,
        vat: 0.00,
        gross: 0.00
      }
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
        await this.$store.dispatch('items/create', this.form)
        this.$bvModal.hide('modal-add-item')
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>
