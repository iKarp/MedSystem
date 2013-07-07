<h2>Пользователь: {$user->login} ({$user->showname()})  [<a href="/auth.php?logout=1">Выйти</a>]</h2>

<div>Доступные АРМ</div>

<ul>
{foreach from=$arms item=arm}
    {if array_key_exists($arm.arm_id,$user->arms)}
        <li><a href="/{$arm.arm_name}/index.php">{$arm.arm_description}</a></li>
    {/if}
{/foreach}
</ul>
