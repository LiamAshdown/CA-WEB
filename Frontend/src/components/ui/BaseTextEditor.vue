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

      <editor-content class="editor__content" :editor="editor" />
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
  watch: {
    value (val) {
      // So cursor doesn't jump to start on typing
      if (this.editor && val !== this.value) {
        this.editor.setContent(val, true)
      }
    }
  },
  data () {
    return {
      editor: null,
      valueName: ''
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
        new History()
      ],
      content: this.value,
      onUpdate: ({ getHTML }) => {
        this.$emit('input', getHTML(), this.valueName)
      }
    })

    this.editor.setContent(this.value)
  },
  beforeDestroy () {
    this.editor.destroy()
  }
}
</script>

<style lang="scss">
.editor {
  border-radius: 6px;

  &__menubar {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 10px;
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

    &:hover {
      background-color: #e2e8f0;
    }
    &--active {
      background-color: #e2e8f0;
    }
  }

  &__content {
    .ProseMirror {
      border: 1px solid #ced4da;
      border-radius: 0px 0px 5px 5px;

      padding: 20px 20px 10px 20px;

      &-focused {
        border: 1px solid #ced4da;
        outline: none;
      }
    }
  }
}
</style>
