<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('*/vendor/*')
    ->exclude('*/storage/*')
    ->exclude('*/node_modules/*')
    ->exclude('*/views/*')
    ->exclude('*/.git/*')
    ->exclude('*/.idea/*')
    ->exclude('*/.vscode/*')
;

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true);

return $config->setRules([
    '@PSR1' => true,
    '@PSR12' => true,
    'array_indentation' => true,
    'array_syntax' => true,
    'assign_null_coalescing_to_coalesce_equal' => true,
    'binary_operator_spaces' => true,
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement' => true,
    'blank_line_between_import_groups' => true,
    'single_space_around_construct' => true,
    'declare_parentheses' => true,
    'cast_spaces' => false,
    'class_attributes_separation' => [
        'elements' => [
            'case' => 'none',
            'const' => 'none',
            'method' => 'one',
            'property' => 'none',
            'trait_import' => 'none',
        ],
    ],
    'class_definition' => [
        'inline_constructor_arguments' => false,
        'single_item_single_line' => true,
        'space_before_parenthesis' => true,
    ],
    'clean_namespace' => true,
    'compact_nullable_type_declaration' => true,
    'concat_space' => ['spacing' => 'one'],
    'constant_case' => true,
    'declare_equal_normalize' => true,
    // RISKY: "declare_strict_types" => true,
    'elseif' => true,
    'encoding' => true,
    'full_opening_tag' => true,
    'function_declaration' => true,
    'heredoc_indentation' => true,
    'indentation_type' => true,
    'line_ending' => true,
    'list_syntax' => true,
    'lowercase_cast' => true,
    'lowercase_keywords' => true,
    'lowercase_static_reference' => true,
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'new_with_parentheses' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_break_comment' => true,
    'no_closing_tag' => true,
    'no_empty_statement' => true,
    'no_leading_import_slash' => true,
    'no_space_around_double_colon' => true,
    'no_spaces_after_function_name' => true,
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'no_unneeded_braces' => true,
    'no_unset_cast' => true,
    'no_unused_imports' => true,
    'no_useless_else' => true,
    'no_useless_nullsafe_operator' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => [
        'after_heredoc' => true,
    ],
    'no_whitespace_in_blank_line' => true,
    'normalize_index_brace' => true,
    'operator_linebreak' => [
        'only_booleans' => false,
        'position' => 'beginning',
    ],
    'control_structure_braces' => true,
    'control_structure_continuation_position' => [
        'position' => 'same_line',
    ],
    'braces_position' => true,
    // 'curly_braces_position' => true,
    "declare_strict_types" => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'new_line_for_chained_calls',
    ],
    'no_extra_blank_lines' => true,
    'no_multiple_statements_per_line' => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'case',
            'constant_public',
            'constant_protected',
            'constant_private',
            'property_public',
            'property_protected',
            'property_private',
            'construct',
            'destruct',
            'magic',
            'phpunit',
            'method_abstract',
            'method_static',
            'method_public',
            'method_public_static',
            'method_protected',
            'method_protected_static',
            'method_private',
            'method_private_static',
            'method_public_abstract',
            'method_protected_abstract',
            'method_private_abstract',
            'method_public_abstract_static',
            'method_protected_abstract_static',
            'method_private_abstract_static',
        ],
    ],
    'ordered_imports' => [
        'imports_order' => [
            'class',
            'function',
            'const',
        ],
        'sort_algorithm' => 'alpha',
    ],
    'php_unit_method_casing' => [
        'case' => 'snake_case',
    ],
    'phpdoc_align' => true,
    'protected_to_private' => true,
    'return_assignment' => true,
    'return_type_declaration' => true,
    'short_scalar_cast' => true,
    'simplified_if_return' => true,
    'single_blank_line_at_eof' => true,
    'single_class_element_per_statement' => [
        'elements' => [
            'const',
            'property',
        ],
    ],
    'single_import_per_statement' => [
        'group_to_single_imports' => false,
    ],
    'single_line_after_imports' => true,
    'single_quote' => [
        'strings_containing_single_quote_chars' => false,
    ],
    'single_trait_insert_per_statement' => true,
    'statement_indentation' => true,
    'spaces_inside_parentheses' => [
        'space' => 'none',
    ],
    'switch_case_semicolon_to_colon' => true,
    'switch_case_space' => true,
    'ternary_operator_spaces' => true,
    'ternary_to_null_coalescing' => true,
    'trailing_comma_in_multiline' => [
        'after_heredoc' => true,
    ],
    'visibility_required' => true,
    'yoda_style' => true,
])->setFinder($finder);
