<template>
  <div class="tax">
    <div class="tax__dropdown shadow">
      <div class="tax__search">
        <div class="p-1 form-control d-flex align-items-center">
          <b-icon icon="search" class="mx-2"></b-icon>
          <input type="seach" placeholder="Search" v-model="filter"/>
        </div>
      </div>
      <div classs="tax__menu" v-if="!loading">
        <div
          v-for="tax in filtered"
          :key="tax.id"
          class="tax__item d-flex justify-content-between"
          @click="selectTax(tax)"
        >
          <span>{{ tax.name }}</span>
          <span>{{ tax.tax }}%</span>
        </div>
        <p class="text-center mt-1" v-if="!filtered.length">No Results...</p>
      </div>
      <div class="tax__loading text-center py-3" v-else>
        <b-spinner variant="primary">Loading</b-spinner>
      </div>
      <div class="tax__add text-primary font-weight-bold" v-b-modal.modal-add-tax>
        <b-icon icon="pencil-fill"></b-icon> Add Tax
      </div>
    </div>
    <add-tax-modal @close="getTaxes"></add-tax-modal>
  </div>
</template>

<script>
import AddTaxModal from '@/components/modals/AddTaxModal.vue'
import api from '@/api/index.js'

export default {
  components: {
    AddTaxModal
  },
  name: 'BillTaxDropdown',
  data () {
    return {
      open: false,
      loading: false,
      filter: '',
      taxes: []
    }
  },
  computed: {
    filtered () {
      return this.taxes.filter(tax => {
        return tax.name.toLowerCase().includes(this.filter)
      })
    }
  },
  methods: {
    async getTaxes () {
      this.loading = true
      this.taxes = await api.tax.index()
      this.loading = false
    },
    selectTax (tax) {
      this.$store.dispatch('bills/addTax', tax)

      this.$emit('selectTax')
    }
  },
  created () {
    this.getTaxes()
  }
}
</script>

<style lang="scss" scoped>
.tax {
  width: 100%;
  position: absolute;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease;

  &--toggle {
    opacity: 1;
    visibility: initial;
  }

  &__dropdown {
    background-color: white;
    width: 100%;
    height: auto;
    position: absolute;
    border-radius: 5px;
  }

  &__search,
  &__item {
    padding: 10px;
  }

  &__search {
    input {
      border: 0px;
      width: 100%;
    }
  }

  &__item {
    &:hover {
      cursor: pointer;
      background-color: darken($color: $white, $amount: 3);
    }
  }

  &__add {
    text-align: center;
    background-color: #f7f7f7;
    padding: 10px;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-radius: 5px;

    &:hover {
      background-color: darken($color: $white, $amount: 6);
      cursor: pointer;
    }
  }
}
</style>
