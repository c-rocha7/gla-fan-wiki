<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Resources\Gameplay\CharacterResource\Pages\ListCharacters;
use App\Filament\Resources\Gameplay\ItemResource\Pages\ListItems;
use App\Filament\Resources\Info\BaseStatuResource\Pages\ListBaseStatus;
use App\Filament\Resources\Info\TagResource\Pages\ListTags;
use App\Filament\Resources\Info\TypeResource\Pages\ListTypes;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups(
                $this->getNavigationGroups()
            )
            ->navigationItems(
                $this->getNavigationItems()
            );
    }

    private function getNavigationGroups(): array
    {
        return [
            NavigationGroup::make()
                ->label('Gameplay')
                ->collapsible()
                ->collapsed(),
            NavigationGroup::make()
                ->label('Info')
                ->collapsible()
                ->collapsed(),
        ];
    }

    private function getNavigationItems(): array
    {
        return [
            // Gameplay
            NavigationItem::make('Personagens')
                ->url(fn (): string => ListCharacters::getUrl())
                ->isActiveWhen(
                    fn (): bool => request()->routeIs(
                        $this->makeWildCardForRouteName(ListCharacters::getRouteName())
                    )
                )
                ->group('Gameplay'),
            NavigationItem::make('Itens')
                ->url(fn (): string => ListItems::getUrl())
                ->isActiveWhen(
                    fn (): bool => request()->routeIs(
                        $this->makeWildCardForRouteName(ListItems::getRouteName())
                    )
                )
                ->group('Gameplay'),

            // Info
            NavigationItem::make('Tags')
                ->url(fn (): string => ListTags::getUrl())
                ->isActiveWhen(
                    fn (): bool => request()->routeIs(
                        $this->makeWildCardForRouteName(ListTags::getRouteName())
                    )
                )
                ->group('Info'),
            NavigationItem::make('Status Base')
                ->url(fn (): string => ListBaseStatus::getUrl())
                ->isActiveWhen(
                    fn (): bool => request()->routeIs(
                        $this->makeWildCardForRouteName(ListBaseStatus::getRouteName())
                    )
                )
                ->group('Info'),
            NavigationItem::make('Tipo')
                ->url(fn (): string => ListTypes::getUrl())
                ->isActiveWhen(
                    fn (): bool => request()->routeIs(
                        $this->makeWildCardForRouteName(ListTypes::getRouteName())
                    )
                )
                ->group('Info'),
        ];
    }

    private function makeWildCardForRouteName(string $routeName, ?int $rewindSegments = 1): string
    {
        if (!str_contains($routeName, '.')) {
            return $routeName;
        }

        $segments    = explode('.', $routeName);
        $rootSegment = array_slice($segments, 0, count($segments) - $rewindSegments);

        return implode('.', $rootSegment).'.*';
    }
}
