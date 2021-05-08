<template>
  <b-modal
    id="modal-add-tax"
    ref="modal"
    title="Add Tax"
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
        v-model="tax.name"
        :validation="errors"
      ></base-form-group>

      <b-form-group
        id="tax-group"
        label="Tax*"
        label-for="tax-input"
        class="font-weight-medium"
      >
        <b-input-group prepend="%">
          <b-form-input v-model.lazy="tax.tax" v-money="money" maxlength="5"></b-form-input>
        </b-input-group>
      </b-form-group>

      <base-form-group
        id="description"
        label="Description"
        type="text"
        v-model="tax.description"
        :textArea="true"
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
import api from '@/api/index.js'

export default {
  name: 'AddTaxModel',
  data () {
    return {
      tax: {
        name: '',
        tax: 0.00,
        description: ''
      },
      errors: [],
      loading: false,
      money: {
        decimal: '.',
        precision: 2,
        masked: false
      }
    }
  },
  methods: {
    resetModal () {
      this.name = ''
      this.percent = 0.00
      this.description = ''
    },
    handleOk (bvModalEvt) {
      bvModalEvt.preventDefault()

      this.onSubmit()
    },
    async onSubmit () {
      this.loading = true
      this.errors = []

      try {
        const response = await api.tax.store(this.tax)

        this.$store.dispatch('bills/addTax', this.tax)

        this.$store.dispatch('toast', {
          message: response.message
        })

        this.$emit('close')

        this.$bvModal.hide('modal-add-tax')
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>
