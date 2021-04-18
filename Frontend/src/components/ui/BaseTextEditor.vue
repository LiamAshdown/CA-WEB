<template>
  <div class="editor">
    <b-form-group
      :id="id"
      :label="label"
      :description="description"
    >
      <editor-menu-bar :editor="editor" v-slot="{ commands, isActive, focused }">
        <div class="editor__menubar" :class="{['editor__menubar--focused']: focused}">

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.bold() }"
            @click="commands.bold"
          >
            <font-awesome-icon icon="bold"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.italic() }"
            @click="commands.italic"
          >
            <font-awesome-icon icon="italic"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.strike() }"
            @click="commands.strike"
          >
            <font-awesome-icon icon="strikethrough"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.underline() }"
            @click="commands.underline"
          >
            <font-awesome-icon icon="underline"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.code() }"
            @click="commands.code"
          >
            <font-awesome-icon icon="code"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.paragraph() }"
            @click="commands.paragraph"
          >
            <font-awesome-icon icon="paragraph"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.heading({ level: 1 }) }"
            @click="commands.heading({ level: 1 })"
          >
            <span class="font-weight-bold">H1</span>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.heading({ level: 2 }) }"
            @click="commands.heading({ level: 2 })"
          >
            <span class="font-weight-bold">H2</span>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.heading({ level: 3 }) }"
            @click="commands.heading({ level: 2 })"
          >
            <span class="font-weight-bold">H3</span>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.bullet_list() }"
            @click="commands.bullet_list"
          >
            <font-awesome-icon icon="list-ul"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.ordered_list() }"
            @click="commands.ordered_list"
          >
            <font-awesome-icon icon="list-ol"/>
          </button>

          <button
            class="editor__button btn"
            :class="{ 'editor__button--active': isActive.blockquote() }"
            @click="commands.blockquote"
          >
            <font-awesome-icon icon="quote-right"/>
          </button>

          <button
            class="editor__button btn"
            @click="commands.undo"
          >
            <font-awesome-icon icon="undo"/>
          </button>

          <button
            class="editor__button btn"
            @click="commands.redo"
          >
            <font-awesome-icon icon="redo"/>
          </button>

        </div>
      </editor-menu-bar>
      <!-- TODO; This could be put into an array instead of hard coding it. -->
      <div class="editor__insert_field" v-click-outside="hideInsertFields">
        <div class="editor__insert_field__button">
          <b-button ref="insertFieldRef" variant="outline-primary" @click="showInsertFields"><b-icon icon="plus"></b-icon>Insert Field</b-button>
          <div ref="insertFieldPop" class="editor__insert_field__submenu shadow-sm rounded mt-1 opacity-0">
            <b-row no-gutters>
              <b-col lg="4" cols="12">
                <div class="editor__insert_field__submenu__item">
                  <p class="font-weight-bold text-capitalize mb-1">Customer</p>
                  <ul class="editor__insert_field__submenu__menu list-unstyled">
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('CUSTOMER_NAME')"><font-awesome-icon icon="sort-down"/>Contact Name</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('CUSTOMER_EMAIL')"><font-awesome-icon icon="sort-down"/>Email</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('CUSTOMER_PHONE')"><font-awesome-icon icon="sort-down"/>Phone</li>
                  </ul>
                </div>
              </b-col>
              <b-col lg="4" cols="12">
                <div class="editor__insert_field__submenu__item">
                  <p class="font-weight-bold text-capitalize mb-1">Invoice</p>
                  <ul class="editor__insert_field__submenu__menu list-unstyled">
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('INVOICE_DATE')"><font-awesome-icon icon="sort-down"/>Date</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('INVOICE_DUE_DATE')"><font-awesome-icon icon="sort-down"/>Due Date</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('INVOICE_REF_NUMBER')"><font-awesome-icon icon="sort-down"/>Ref Number</li>
                  </ul>
                </div>
              </b-col>
              <b-col lg="4" cols="12">
                <div class="editor__insert_field__submenu__item">
                  <p class="font-weight-bold text-capitalize mb-1">Company</p>
                  <ul class="editor__insert_field__submenu__menu list-unstyled">
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('COMPANY_NAME')"><font-awesome-icon icon="sort-down"/>Company Name</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('COMPANY_PHONE')"><font-awesome-icon icon="sort-down"/>Phone</li>
                    <li class="editor__insert_field__submenu__menu__item" @click="insertField('COMPANY_ADDRESS')"><font-awesome-icon icon="sort-down"/>Address</li>
                  </ul>
                </div>
              </b-col>
            </b-row>
          </div>
        </div>
      </div>
      <editor-content class="editor__content" :editor="editor"/>
    </b-form-group>
  </div>
</template>

<script>
import { camelize } from 'humps'

import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {
  Blockquote,
  CodeBlock,
  HardBreak,
  Heading,
  OrderedList,
  BulletList,
  ListItem,
  TodoItem,
  TodoList,
  Bold,
  Code,
  Italic,
  Link,
  Strike,
  Underline,
  History
} from 'tiptap-extensions'
import InsertField from '@/vendor/tiptap-insert-field'
import { createPopper } from '@popperjs/core'

export default {
  components: {
    EditorContent,
    EditorMenuBar
  },
  props: {
    id: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: false,
      default: ''
    },
    value: {
      type: String
    }
  },
  data () {
    return {
      editor: null,
      popper: null,
      valueName: '',
      emitAfterOnUpdate: false
    }
  },
  watch: {
    value (val) {
      if (this.emitAfterOnUpdate) {
        this.emitAfterOnUpdate = false
        return
      }

      if (this.editor) {
        this.editor.setContent(val)
      }
    }
  },
  methods: {
    showInsertFields () {
      // Update position first and then set the visibility
      this.popper.update().then(() => {
        // TODO; This could be set better, maybe do the styles in an object?
        this.$refs.insertFieldPop.style.visibility = 'visible'
        this.$refs.insertFieldPop.style.pointerEvents = 'initial'
      })
    },
    hideInsertFields () {
      // TODO; This could be set better, maybe do the styles in an object?
      this.$refs.insertFieldPop.style.visibility = 'hidden'
      this.$refs.insertFieldPop.style.pointerEvents = 'none'
    },
    insertField (field) {
      this.editor.commands.insertHTML(`<b>{${field}}</b>`)

      this.hideInsertFields()
    }
  },
  mounted () {
    this.valueName = camelize(this.id)

    this.editor = new Editor({
      extensions: [
        new Blockquote(),
        new BulletList(),
        new CodeBlock(),
        new HardBreak(),
        new Heading({ levels: [1, 2, 3] }),
        new ListItem(),
        new OrderedList(),
        new TodoItem(),
        new TodoList(),
        new Link(),
        new Bold(),
        new Code(),
        new Italic(),
        new Strike(),
        new Underline(),
        new History(),
        new InsertField()
      ],
      content: '',
      onUpdate: ({ getHTML }) => {
        this.emitAfterOnUpdate = true
        this.$emit('input', getHTML(), this.valueName)
      }
    })

    this.editor.setContent(this.value)

    this.popper = createPopper(this.$refs.insertFieldRef, this.$refs.insertFieldPop, {
      placement: 'bottom-start'
    })
  },
  beforeDestroy () {
    this.editor.destroy()
  }
}
</script>

<style lang="scss">
.editor {
  border-radius: 6px;
  position: relative;

  &__menubar {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 3px;
    border: 1px solid #ced4da;
    border-bottom: 0px;
    border-radius: 5px 5px 0px 0px;
    background: #fff;

    &--focused {
      border: 1px solid #ced4da;
      border-bottom: 0px;
      outline: none;
    }
  }

  &__button {
    display: flex;
    align-items: center;

    &--active,
    &:hover {
      background-color: #e2e8f0;
    }
  }

  &__content {
    .ProseMirror {
      min-height: 150px;
      border: 1px solid #ced4da;
      border-radius: 0px 0px 5px 5px;

      padding: 20px 20px 10px 20px;

      &-focused {
        border: 1px solid #ced4da;
        outline: none;
      }
    }
  }

  &__insert_field {
    width: 100%;
    z-index: 99;
    position: absolute;
    bottom: 10px;
    right: 10px;

    &__button {
      float: right;
    }

    &__submenu {
      padding: 10px;
      background: white;
      width: 100%;
      max-width: 600px;
      animation: slideIn 0.3s ease;
      visibility: hidden;
      pointer-events: none;

      &__menu {
        &__item {
          &:hover {
            cursor: pointer;
            background: darken($color: #edf2f7, $amount: 0);
          }

          svg {
            margin-right: 10px;
          }
        }
      }

      svg {
        transform: rotate(270deg);
      }
    }
  }
}
</style>
