<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->exclude("node_modules")
    ->exclude("tests/Support/_generated")
    ->exclude("vendor")
    ->ignoreDotFiles(false)
    ->in(__DIR__);

$config = new Config();

$config->setRules(
    [
        "@PSR12"         => true,
        "@PSR12:risky"   => true,
        "@Symfony"       => true,
        "@Symfony:risky" => true,

        "binary_operator_spaces" => [
            "default" => "align",
        ],

        "class_attributes_separation"        => false,
        "combine_consecutive_unsets"         => true,
        "concat_space"                       => false,
        "ereg_to_preg"                       => true,
        "final_internal_class"               => true,
        "global_namespace_import"            => false,
        "increment_style"                    => false,
        "is_null"                            => false,
        "mb_str_functions"                   => true,
        "native_constant_invocation"         => false,
        "native_function_invocation"         => false,
        "no_blank_lines_after_class_opening" => true,
        "no_extra_blank_lines"               => false,
        "no_null_property_initialization"    => false,
        "no_superfluous_phpdoc_tags"         => false,
        "no_unneeded_control_parentheses"    => false,
        "no_useless_else"                    => true,
        "no_useless_return"                  => true,

        "ordered_class_elements" => [
            "order" => [
                "use_trait",
                "case",
                "constant_public",
                "constant_protected",
                "constant_private",
                "property_public",
                "property_protected",
                "property_private",
                "construct",
                "destruct",
                "phpunit",
                "method",
                "magic",
            ],
        ],

        "ordered_imports"             => true,
        "ordered_interfaces"          => true,
        "ordered_types"               => true,
        "phpdoc_summary"              => false,
        "phpdoc_to_comment"           => false,
        "random_api_migration"        => true,
        "single_import_per_statement" => false,
        "single_line_comment_spacing" => false,
        "single_line_throw"           => false,
        "single_quote"                => false,
        "strict_comparison"           => true,
        "strict_param"                => true,
        "ternary_to_null_coalescing"  => true,

        "trailing_comma_in_multiline" => [
            "elements" => [
                "arrays",
            ],
        ],

        "yoda_style" => false,
    ]
);

$config->setFinder($finder);

return $config;
