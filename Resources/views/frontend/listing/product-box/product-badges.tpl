{extends file="parent:frontend/listing/product-box/product-badges.tpl"}

{block name='frontend_listing_box_coha_badges'}
    {for $foo=$start to $end}
        {if $sArticle["coha_badges_{$foo}_active"] == 1}
            {$sBadgeColor = $sArticle["coha_badges_{$foo}_color"]}
            {$sBadgeBg = ''}
            {$sBadgedClass = ''}

            {if (strpos($sBadgeColor, '#') === 0 || strpos($sBadgeColor, 'rgba') === 0)}
                {$sBadgeBg = $sBadgeColor}
            {else}
                {$sBadgedClass = $sBadgeColor}
            {/if}
            <div 
                class="product--badge coha--badge {$sBadgedClass}" 
                {if $sBadgeBg}style="background-color: {$sBadgeBg};"{/if}>
                {$sArticle["coha_badges_{$foo}_text"]}
            </div>
        {else}
            {$foo = $end}
        {/if}
    {/for}
{/block}

{* Discount badge *}
{block name='frontend_listing_box_article_discount'}

    {* Before Coha Badgeds Loop *}
    {$start = 1}
    {$end   = 5}
    {block name='frontend_listing_box_coha_badges'}
        {$smarty.block.parent}
    {/block}

    {$smarty.block.parent}
{/block}

{* ESD product badge *}
{block name='frontend_listing_box_article_esd'}
    {$smarty.block.parent}

    {* Last Coha Badgeds Loop *}

    {$start = 6}
    {$end   = 10}
    {block name='frontend_listing_box_coha_badges'}
        jo
        {$smarty.block.parent}
    {/block}
{/block}

