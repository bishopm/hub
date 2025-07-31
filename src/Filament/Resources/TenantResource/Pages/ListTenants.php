<?php

namespace Bishopm\Hub\Filament\Resources\TenantResource\Pages;

use Bishopm\Hub\Filament\Resources\TenantResource;
use Bishopm\Hub\Jobs\SendEmail;
use Bishopm\Hub\Mail\HubMail;
use Bishopm\Hub\Models\Tenant;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListTenants extends ListRecords
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Group email')->label('Email tenants')
                ->form([
                    TextInput::make('subject'),
                    FileUpload::make('attachment')->preserveFilenames()->directory('attachments'),
                    MarkdownEditor::make('body')
                ])
                ->action(function (array $data) {
                    self::sendEmail($data);
                }),
            Actions\CreateAction::make(),
        ];
    }

    public function sendEmail($data){
        $tenants=Tenant::whereNotNull('email')->where('active',1)->get()->toArray();
        $count=0;
        foreach ($tenants as $tenant){
            if ($tenant['email']){
                $template = new HubMail($data,$tenant);
                if ($tenant['email']=="michael@bishop.net.za"){
                    SendEmail::dispatch($tenant['email'], $template);
                }
            }
            $count++;
        }
        if ($count>0){
            Notification::make('Email sent')->title('Email sent to ' . $count . ' tenants')->send();
        }
    }
}
