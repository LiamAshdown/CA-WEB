<template>
  <b-container class="bill" fluid>
    <div class="bill__header">
      <h1 class="page-title">Create bill</h1>
      <div class="bill__header__buttons">
        <base-button @click="viewDraft" class="mr-2"><b-icon icon="pencil"></b-icon> View Draft</base-button>
        <base-button @click="saveChanges"><font-awesome-icon icon="save"/> Save Changes</base-button>
      </div>
    </div>
    <b-row class="mb-4">
      <b-col cols="12">
        <base-card :loading="initializing">
          <p class="font-weight-bold">Basic Info</p>
          <b-row>
            <b-col class="mb-4" xl="6" cols="12">
              <div class="customer">
                <label for="select-customer">Customer</label>
                <customer-dropdown id="select-customer" @selectedCustomer="selectedCustomer" :customer="bill.customer" :validated="validation.customer.pass"></customer-dropdown>
              </div>
            </b-col>
            <b-col xl="6" cols="12">
              <b-form-row fluid>
                <b-col lg="6" cols="12">
                  <b-form-group
                    id="bill-due-date-group"
                    label="Due Date"
                    description="Not setting a due date will automatically set todays date"
                    label-for="duedate-input">
                    <b-form-datepicker
                      id="bill-due-date"
                      :value="bill.dueDate"
                      @input="updateField($event, 'dueDate')"
                    ></b-form-datepicker>
                  </b-form-group>
                </b-col>
                <b-col lg="6" cols="12" class="mt-1 mt-lg-0">
                  <!-- TODO; BaseFormGroup does not support prepend/append, so using default boostrap to achieve this -->
                  <b-form-group
                    id="bill-number-group"
                    label-class="text-capitalize"
                    :label="type + ' Number'"
                    label-for="bill-number"
                  >
                    <b-input-group :prepend="bill.prefix">
                      <b-form-input
                        id="bill-number"
                        :value="bill.number"
                        @input="updateField($event, 'number')"
                      ></b-form-input>
                    </b-input-group>
                  </b-form-group>
                </b-col>
              </b-form-row>
            </b-col>
          </b-row>
        </base-card>
      </b-col>
    </b-row>
    <b-row class="mb-4">
      <b-col cols="12">
        <bill-items :validation="validation.items"></bill-items>
      </b-col>
    </b-row>
    <b-row>
      <b-col lg="6" cols="12" class="mb-4">
        <base-card :loading="initializing">
          <p class="font-weight-bold">Notes & Term Conditions</p>
          <b-row>
            <b-col cols="12">
              <b-form-group
                id="bill-body"
                label="Email Body"
                label-for="bill-body-input"
              >
                <base-text-editor
                  id="bill-body-input"
                  :value="bill.body"
                  @input="updateField($event, 'body')"
                ></base-text-editor>
              </b-form-group>
            </b-col>
            <b-col cols="12">
              <b-form-group
                label="Terms & Conditions"
                label-for="terms-conditions"
              >
                <base-text-editor
                  id="terms-conditions"
                  :value="bill.termsConditions"
                  @input="updateField($event, 'termsConditions')"
                ></base-text-editor>
              </b-form-group>
            </b-col>
          </b-row>
        </base-card>
      </b-col>
      <b-col lg="6" cols="12" class="d-flex justify-content-end">
        <base-card class="w-100 w-lg-50">
          <div v-click-outside="hideTax">
            <div class="bill__total d-flex justify-content-between text-uppercase">
              <label class="font-weight-bold">Sub Total</label>
              <label>£{{ calculateSubTotalAmount }}</label>
            </div>
            <div
              v-for="(tax, index) in taxes"
              :key="tax.uniqueId"
              class="d-flex justify-content-between text-uppercase"
              >
                <label class="font-weight-bold text-primary">{{ tax.name }}</label>
                <div>
                  <label class="font-weight-bold text-primary mr-3">{{ tax.tax }}%</label>
                  <label class="font-weight-bold bill__remove_tax" @click="removeTax(index)"><b-icon icon="trash-fill"></b-icon></label>
                </div>
            </div>
            <div class="position-relative">
              <bill-tax-dropdown :class="{['tax--toggle']: toggleTax}" @selectTax="selectTax"></bill-tax-dropdown>
              <p class="text-primary font-weight-bold text-right bill__add_tax" @click="showTax">+ Add Tax</p>
            </div>
            <base-divider class="mt-2"></base-divider>
            <div class="bill__total d-flex justify-content-between text-uppercase">
              <label class="font-weight-bold">Total Amount</label>
              <label class="text-primary font-weight-bold">£{{ calculateTotalAmount }}</label>
            </div>
          </div>
        </base-card>
      </b-col>
    </b-row>
    <add-customer-modal></add-customer-modal>
    <!-- TODO; When adding an item, the BillItem should automatically select the newly created item -->
    <add-item-modal></add-item-modal>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'
import CustomerDropdown from '@/components/billing/CustomerDropdown'
import AddCustomerModal from '@/components/modals/AddCustomerModal'
import AddItemModal from '@/components/modals/AddItemModal'
import BillItems from '@/components/billing/BillItems'
import BillTaxDropdown from '@/components/billing/BillTaxDropdown'

export default {
  name: 'Createbill',
  components: {
    CustomerDropdown,
    AddCustomerModal,
    AddItemModal,
    BillItems,
    BillTaxDropdown
  },
  data () {
    return {
      initializing: true,
      type: this.$route.params.type,
      toggleTax: false,
      // Used for basic validation before we submit to server
      validation: {
        customer: {
          pass: true
        },
        dueDate: {
          pass: true
        }
      }
    }
  },
  watch: {
    $route (to, from) {
      if (from.name !== 'DraftBill' && from.name !== 'CreateBill') {
        this.$store.dispatch('bills/reset')
        this.$destroy()
      }
    }
  },
  computed: {
    ...mapGetters({
      bill: 'bills/bill',
      items: 'bills/items',
      taxes: 'bills/taxes',
      saveDraft: 'bills/saveDraft'
    }),
    calculateTotalAmount () {
      let total = 0

      for (const item of this.items) {
        let price = item.price
        for (const tax of this.taxes) {
          price = price - (price * (tax.tax / 100))
        }
        total += Number(price) * item.quantity
      }

      return total.toLocaleString('en-GB', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    },
    calculateSubTotalAmount () {
      let subTotal = 0

      for (const item of this.items) {
        subTotal += Number(item.price) * item.quantity
      }

      return subTotal.toLocaleString('en-GB', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    }
  },
  methods: {
    selectedCustomer (customer) {
      this.updateField(customer, 'customer')
      this.validation.customer.pass = true
    },
    async initialize () {
      await this.$store.dispatch('bills/create', {
        type: this.type
      })

      this.initializing = false
    },
    updateField (value, field) {
      this.$store.dispatch('bills/set', {
        [field]: value
      })
    },
    showTax () {
      this.toggleTax = true
    },
    hideTax () {
      this.toggleTax = false
    },
    selectTax () {
      this.toggleTax = false
    },
    removeTax (index) {
      this.$store.dispatch('bills/removeTax', {
        index: index
      })
    },
    validate () {
      let pass = true

      // Lets validate the data first before we create a draft
      if (!this.bill.customer) {
        this.validation.customer.pass = false
        pass = false
      }

      for (const [key, item] of this.items.entries()) {
        // If item does not have a name, means we have not selected any yet
        if (item.name === '') {
          this.$store.dispatch('bills/setItem', {
            item: {
              passed: false
            },
            index: key
          })

          pass = false
        }
      }

      return pass
    },
    viewDraft () {
      if (!this.validate()) {
        return
      }

      this.$router.push({ name: 'DraftBill' })
    },
    async saveChanges () {
      if (!this.validate()) {
        return
      }

      if (this.validate()) {
        try {
          await this.$store.dispatch('bills/store')
        } catch (error) {
        }
      }
    }
  },
  created () {
    this.initialize()
  }
}
</script>

<style lang="scss">
.bill {
  &__header {
    position: relative;

    &__buttons {
      position: absolute;
      right: 0px;
      top: 0px;
    }
  }

  &__add_tax {
    &:hover {
      cursor: pointer;
    }
  }

  &__total {
    label {
      &:first-child {
        font-size: 14px;
      }
    }
  }

  &__remove_tax {
    &:hover {
      cursor: pointer;
    }
  }
}
</style>
