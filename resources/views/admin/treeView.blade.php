@extends('admin.layouts.app')

@section('content')
  <div class="mx-auto text-white">
    <div id="app" class="container mx-auto p-8">

    <!-- Breadcrumb Navigation -->
    <div class="profile-card rounded-lg p-4 mb-6">
      <div class="flex items-center space-x-2 text-sm">
      <span class="text-gray-400">Navigation:</span>
      <div class="flex items-center space-x-1">
        <div v-for="(item, index) in breadcrumb" :key="item.id" class="flex items-center">
        <div @click="navigateToNode(item)"
          class="breadcrumb-item px-3 py-1 rounded-md text-white bg-gray-800 hover:bg-gray-900"
          :class="{ 'bg-gray-900 hover:bg-gray-900': index === breadcrumb.length - 1 }">
          @{{ item.name }}
        </div>
        <span v-if="index < breadcrumb.length - 1" class="text-gray-400 mx-2">
          >
        </span>
        </div>
      </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div v-if="containerWidth > 800" class="profile-card rounded-lg p-2 mb-4 text-center">
      <p class="text-gray-300 text-sm">
      <span class="inline-flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M7 16l4-4m0 0l4-4m-4 4H3m18 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Tree is wide - scroll horizontally to see all nodes
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 8l4 4m0 0l-4 4m4-4H7m10 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </span>
      </p>
    </div>

    <div class="profile-card rounded-xl p-8 overflow-x-auto overflow-y-hidden">
      <div class="relative"
      :style="{ minHeight: '280px', minWidth: containerWidth + 'px', width: containerWidth + 'px' }">
      <!-- SVG for connection lines and arrows -->
      <svg class="absolute inset-0 w-full h-full pointer-events-none" style="z-index: 1">
        <defs>
        <marker id="arrowhead" markerWidth="8" markerHeight="6" refX="7" refY="3" orient="auto"
          markerUnits="strokeWidth">
          <polygon points="0 0, 8 3, 0 6" class="arrow-head" />
        </marker>
        </defs>
        <g v-for="connection in visibleConnections" :key="connection.id">
        <path :d="connection.path" :class="connection.hasArrow ? 'connection-arrow' : 'tree-line'"></path>
        </g>
      </svg>

      <!-- Tree nodes -->
      <div class="relative" style="z-index: 2">
        <div v-for="node in visibleNodes" :key="node.id" :style="{ 
      position: 'absolute', 
      left: node.displayX + 'px', 
      top: node.displayY + 'px',
      transform: 'translate(-50%, -50%)'
      }" class="tree-node">
        <div @click="selectNode(node)"
          class="border-2 rounded-lg px-6 py-3 text-center hover:opacity-90 transition-all cursor-pointer transform hover:scale-105 font-semibold"
          :class="{ 
      'bg-gray-900 text-white border-gray-800': node.isRoot,
      'highlight-box text-white border-gray-900': !node.isRoot,
      'shadow-lg': node.isRoot
      }" style="
      min-width: 140px;
      min-height: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      ">
          <div class="font-semibold text-sm leading-tight break-words">
          @{{ node.name }}
          </div>
          <div v-if="node.hasChildren" class="text-xs opacity-70 mt-1">
          @{{ node.children.length }} children
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script>
    const { createApp, ref, computed } = Vue;

    createApp({
    setup() {
      const originalTreeData = JSON.parse(@json($hierarchy)); 
      const currentRoot = ref(originalTreeData);
      const breadcrumb = ref([originalTreeData]);
      const nodeMap = ref(new Map());
      const containerWidth = ref(800);

      // Build a map of all nodes for easy lookup
      function buildNodeMap(node, parent = null) {
      nodeMap.value.set(node.id, { ...node, parent });
      if (node.children) {
        node.children.forEach((child) => buildNodeMap(child, node));
      }
      }

      buildNodeMap(originalTreeData);

      // Calculate display positions - fully dynamic positioning with compact layout
      const visibleNodes = computed(() => {
      const nodes = [];
      const root = currentRoot.value;
      const NODE_WIDTH = 160; // Node width including padding
      const MIN_SPACING = 40; // Reduced gap between nodes
      const ROOT_Y = 60; // Root position from top
      const CHILDREN_Y = 160; // Reduced gap - children closer to root
      const LEVEL_SPACING = 100; // Vertical spacing between levels

      // Only show current root and its direct children (simple two-level layout)
      const childrenCount = root.children ? root.children.length : 0;

      // Calculate required width dynamically
      const minWidthForChildren =
        childrenCount * NODE_WIDTH +
        Math.max(0, childrenCount - 1) * MIN_SPACING;
      const requiredWidth = Math.max(600, minWidthForChildren + 160); // Reduced padding

      // Update container width
      containerWidth.value = requiredWidth;

      const centerX = containerWidth.value / 2;

      // Add current root at top center
      nodes.push({
        ...root,
        displayX: centerX,
        displayY: ROOT_Y,
        displayLevel: 0,
        isRoot: true,
        hasChildren: root.children && root.children.length > 0,
      });

      // Add all children in a horizontal row below the root
      if (root.children && root.children.length > 0) {
        if (childrenCount === 1) {
        // Single child - center it under parent
        nodes.push({
          ...root.children[0],
          displayX: centerX,
          displayY: CHILDREN_Y,
          displayLevel: 1,
          isRoot: false,
          hasChildren:
          root.children[0].children &&
          root.children[0].children.length > 0,
        });
        } else {
        // Multiple children - distribute evenly
        const totalChildrenWidth =
          (childrenCount - 1) * (NODE_WIDTH + MIN_SPACING);
        const childrenStartX = centerX - totalChildrenWidth / 2;

        root.children.forEach((child, index) => {
          const childX =
          childrenStartX + index * (NODE_WIDTH + MIN_SPACING);
          nodes.push({
          ...child,
          displayX: childX,
          displayY: CHILDREN_Y,
          displayLevel: 1,
          isRoot: false,
          hasChildren: child.children && child.children.length > 0,
          });
        });
        }
      }

      return nodes;
      });

      const visibleConnections = computed(() => {
      const connections = [];
      const nodes = visibleNodes.value;
      const root = nodes.find((n) => n.isRoot);

      if (!root || !root.hasChildren) return connections;

      const children = nodes.filter((n) => !n.isRoot);

      if (children.length > 0) {
        const rootX = root.displayX;
        const rootY = root.displayY + 30; // Bottom of root node (reduced)
        const midY = rootY + 25; // Shorter vertical line from root

        // Draw vertical line down from root
        connections.push({
        id: "root-vertical",
        path: `M ${rootX} ${rootY} L ${rootX} ${midY}`,
        hasArrow: false,
        });

        if (children.length > 1) {
        // Draw horizontal line connecting all children
        const leftmostX = Math.min(...children.map((c) => c.displayX));
        const rightmostX = Math.max(...children.map((c) => c.displayX));
        connections.push({
          id: "horizontal-connector",
          path: `M ${leftmostX} ${midY} L ${rightmostX} ${midY}`,
          hasArrow: false,
        });
        }

        // Draw vertical lines down to each child with arrows
        children.forEach((child) => {
        const childX = child.displayX;
        const childY = child.displayY - 30; // Top of child node (reduced)

        connections.push({
          id: `vertical-to-${child.id}`,
          path: `M ${childX} ${midY} L ${childX} ${childY}`,
          hasArrow: true,
        });
        });
      }

      return connections;
      });

      function selectNode(node) {
      if (node.id === currentRoot.value.id) return;

      // Update current root
      currentRoot.value = node;

      // Update breadcrumb
      const newBreadcrumb = [originalTreeData];
      let current = nodeMap.value.get(node.id);
      const path = [];

      while (current && current.id !== originalTreeData.id) {
        path.unshift(current);
        current = current.parent
        ? nodeMap.value.get(current.parent.id)
        : null;
      }

      newBreadcrumb.push(
        ...path.map((p) => nodeMap.value.get(p.id)).filter(Boolean)
      );
      breadcrumb.value = newBreadcrumb;
      }

      function navigateToNode(node) {
      currentRoot.value = node;

      // Update breadcrumb to show path to this node
      const newBreadcrumb = [originalTreeData];
      if (node.id !== originalTreeData.id) {
        let current = nodeMap.value.get(node.id);
        const path = [];

        while (current && current.id !== originalTreeData.id) {
        path.unshift(current);
        current = current.parent
          ? nodeMap.value.get(current.parent.id)
          : null;
        }

        newBreadcrumb.push(
        ...path.map((p) => nodeMap.value.get(p.id)).filter(Boolean)
        );
      }
      breadcrumb.value = newBreadcrumb;
      }

      return {
      currentRoot,
      breadcrumb,
      visibleNodes,
      visibleConnections,
      containerWidth,
      selectNode,
      navigateToNode,
      };
    },
    }).mount("#app");
  </script>
@endsection